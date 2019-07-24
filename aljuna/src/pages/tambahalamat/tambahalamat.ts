import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, LoadingController } from 'ionic-angular';
import { Service } from '../service/service';
import { AbstractControl, FormGroup, FormBuilder, Validators } from '@angular/forms';

@IonicPage()
@Component({
  selector: 'page-tambahalamat',
  templateUrl: 'tambahalamat.html',
})
export class TambahalamatPage {
  alamat: any = {};
  kota: any = [];

  formgroup: FormGroup;
  nama: AbstractControl;
  id_kota: AbstractControl;
  alamat2: AbstractControl;
  no_telp: AbstractControl;

  constructor(public navCtrl: NavController, public navParams: NavParams, private service: Service, public formbuilder: FormBuilder,private loadingCtrl: LoadingController) {
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

  getKota() {
    this.service.getKota().subscribe(output => {
      this.kota = output;
    }, err => {
      console.log(err);
    });
  }

  tambah() {
    if (this.alamat.nama == null || this.alamat.nama == "") {
      this.service.showToast('Nama harus diisi!', 'toastMerah');
    } else if (this.alamat.id_kota == null || this.alamat.id_kota == "") {
      this.service.showToast('Kota harus diisi!', 'toastMerah');
    } else if (this.alamat.alamat == null || this.alamat.alamat == "") {
      this.service.showToast('Alamat harus diisi!', 'toastMerah');
    } else if (this.alamat.no_telp == null || this.alamat.no_telp == "") {
      this.service.showToast('Nomor telepon harus diisi!', 'toastMerah');
    } else {
      this.alamat.action = "tambah";
      let loader = this.loadingCtrl.create({
        content: "Mohon tunggu..."
      });
      loader.present().then(() => {
      this.service.crudAlamat(this.alamat).subscribe(res => {
        loader.dismiss();
        if (res == "success") {
          this.service.showToast("Alamat berhasil ditambahkan", 'toastBiru');
          this.navCtrl.pop();
        }
        else {
          this.service.showToast("Terjadi Kesalahan", 'toastMerah');
        }
      }, err => {
        console.log(err);
      });
    });
    }
  }

}
