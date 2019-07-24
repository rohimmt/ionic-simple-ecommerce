import { Http } from '@angular/http';
import { Component, ViewChild } from '@angular/core';
import { IonicPage, NavController, NavParams, ViewController, LoadingController} from 'ionic-angular';
import { MasukPage } from '../masuk/masuk';
import { Service } from '../service/service';
import { FormBuilder, FormGroup, Validators, AbstractControl } from '@angular/forms';
import { resolveDep } from '@angular/core/src/view/provider';

@IonicPage()
@Component({
  selector: 'page-daftar',
  templateUrl: 'daftar.html',
})
export class DaftarPage {
  kota: any = [];
  daftar: any = {};

  formgroup:FormGroup;
  username:AbstractControl;
  password:AbstractControl;
  id_kota:AbstractControl;
  nama:AbstractControl;
  alamat:AbstractControl;
  no_telp:AbstractControl;

  constructor(
    public navCtrl: NavController,
    public http: Http,
    public viewCtrl: ViewController,
    private service: Service,private loadingCtrl: LoadingController,
    public formbuilder:FormBuilder) {
      this.formgroup = formbuilder.group({
        username:['', Validators.compose([Validators.minLength(3), Validators.pattern('[a-zA-Z 0-9]*'), Validators.required])],
        password:['', Validators.compose([Validators.minLength(6), Validators.pattern('[a-zA-Z 0-9]*'), Validators.required])],
        id_kota:['', Validators.required],
        nama:['', Validators.required],
        alamat:['', Validators.required],
        no_telp:['', Validators.compose([Validators.pattern('[0-9]*'), Validators.required])]
      });

      this.username = this.formgroup.controls['username'];
      this.password = this.formgroup.controls['password'];
      this.id_kota = this.formgroup.controls['id_kota'];
      this.nama = this.formgroup.controls['nama'];
      this.alamat = this.formgroup.controls['alamat'];
      this.no_telp = this.formgroup.controls['no_telp'];
  }

  ionViewWillEnter() {
    this.getKota();
  }

  getKota() {
    this.service.getKota().subscribe(res => {
      this.kota = res;
    }, err => {
      console.log(err);
    });
  }

  goToMasuk() {
    this.navCtrl.setRoot(MasukPage);
  }

  submit() {
    let loader = this.loadingCtrl.create({
      content: "Mohon tunggu..."
    });
    loader.present().then(() => {
    this.daftar.action = "submit";
    this.service.daftar(this.daftar).subscribe(res => {
      if (res == "success") {
        this.service.showToast("Pendaftaran Berhasil",'toastBiru');
        this.navCtrl.setRoot(MasukPage);
        loader.dismiss();
      }
      else {
        this.service.showToast("Terjadi Kesalahan",'toastMerah');
        loader.dismiss();
      }
    }, err => {
      console.log(err);
    });
  });
  }
}
