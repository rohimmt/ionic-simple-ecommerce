import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, LoadingController } from 'ionic-angular';
import { Service } from '../service/service';
import { AbstractControl, FormGroup, FormBuilder, Validators } from '@angular/forms';

@IonicPage()
@Component({
  selector: 'page-editalamat',
  templateUrl: 'editalamat.html',
})
export class EditalamatPage {
  value: any;
  alamat: any = {};
  kota: any = [];

  formgroup: FormGroup;
  nama: AbstractControl;
  id_kota: AbstractControl;
  alamat2: AbstractControl;
  no_telp: AbstractControl;

  constructor(public navCtrl: NavController, public navParams: NavParams, private service: Service, public formbuilder: FormBuilder, private loadingCtrl: LoadingController) {
    this.value = navParams.get('a');
    this.formgroup = formbuilder.group({
      nama: ['', Validators.required],
      id_kota: ['', Validators.required],
      alamat2: ['', Validators.required],
      no_telp: ['', Validators.compose([Validators.pattern('[0-9]*'), Validators.required])]
    });

    this.nama = this.formgroup.controls['nama'];
    this.id_kota = this.formgroup.controls['id_kota'];
    this.alamat2 = this.formgroup.controls['alamat2'];
    this.no_telp = this.formgroup.controls['no_telp'];
  }

  ionViewWillEnter() {
    this.getKota();
  }

  ionViewDidLoad() {
    this.alamat.id_alamat = this.value.id_alamat;
    this.alamat.nama = this.value.nama;
    this.alamat.id_kota = this.value.id_kota;
    this.alamat.alamat = this.value.alamat;
    this.alamat.no_telp = this.value.no_telp;
  }

  getKota() {
    let loader = this.loadingCtrl.create({
      content: "Mohon tunggu..."
    });
    loader.present().then(() => {
      this.service.getKota().subscribe(res => {
        this.kota = res;
      }, err => {
        console.log(err);
      });
      loader.dismiss();
    });
  }

  edit() {
    let loader = this.loadingCtrl.create({
      content: "Mohon tunggu..."
    });
    loader.present().then(() => {
      this.alamat.action = "edit";
      this.service.crudAlamat(this.alamat).subscribe(res => {
        if (res == "success") {
          this.service.showToast("Alamat berhasil disimpan", 'toastBiru');
          this.navCtrl.pop();
          loader.dismiss();
        }
        else {
          this.service.showToast("Terjadi Kesalahan", 'toastMerah');
          loader.dismiss();
        }
      }, err => {
        console.log(err);
      });
    });
  }
}
