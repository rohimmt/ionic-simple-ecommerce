import { Component, ViewChild } from '@angular/core';
import { IonicPage, NavController, NavParams, AlertController } from 'ionic-angular';
import { LoadingController, ToastController } from 'ionic-angular';
import { Service } from '../service/service';
import { AbstractControl, FormGroup, FormBuilder, Validators } from '@angular/forms';


@IonicPage()
@Component({
  selector: 'page-pengaturan',
  templateUrl: 'pengaturan.html',
})
export class PengaturanPage {
  @ViewChild("username") username;
  @ViewChild("password") password;
  @ViewChild("nama") nama;
  @ViewChild("id_kota") id_kota;
  @ViewChild("alamat") alamat;
  @ViewChild("no_telp") no_telp;
  @ViewChild("password1") password1;
  @ViewChild("password2") password2;
  @ViewChild("password3") password3;

  user: any = [];
  kota: any = [];

  formgroup1: FormGroup;
  formgroup2: FormGroup;
  user1: AbstractControl;
  pass: AbstractControl;
  pass1: AbstractControl;
  pass2: AbstractControl;
  pass3: AbstractControl;

  constructor(public navCtrl: NavController, public alertCtrl: AlertController, public toastCtrl: ToastController,
    public loadingCtrl: LoadingController, private service: Service, public formbuilder: FormBuilder) {
    this.formgroup1 = formbuilder.group({
      user1: ['', Validators.compose([Validators.minLength(3), Validators.pattern('[a-zA-Z 0-9]*'), Validators.required])],
      pass: ['', Validators.compose([Validators.minLength(6), Validators.pattern('[a-zA-Z 0-9]*'), Validators.required])]
    });
    this.formgroup2 = formbuilder.group({
      pass1: ['', Validators.compose([Validators.minLength(6), Validators.pattern('[a-zA-Z 0-9]*'), Validators.required])],
      pass2: ['', Validators.compose([Validators.minLength(6), Validators.pattern('[a-zA-Z 0-9]*'), Validators.required])],
      pass3: ['', Validators.compose([Validators.minLength(6), Validators.pattern('[a-zA-Z 0-9]*'), Validators.required])]
    });

    this.user1 = this.formgroup1.controls['user1'];
    this.pass = this.formgroup1.controls['pass'];
    this.pass1 = this.formgroup2.controls['pass1'];
    this.pass2 = this.formgroup2.controls['pass2'];
    this.pass3 = this.formgroup2.controls['pass3'];
  }

  ionViewWillEnter() {

    this.getUser();
    this.getKota();

  }

  getUser() {
    let loader = this.loadingCtrl.create({
      content: "Mohon tunggu..."
    });
    loader.present().then(() => {
      this.service.getUser().subscribe(output => {
        this.user = output;
        loader.dismiss();
      }, err => {
        console.log(err);
      });
    });
  }

  getKota() {
    this.service.getKota().subscribe(output => {
      this.kota = output;
    }, err => {
      console.log(err);
    });
  }

  ubahUsername() {
    let loader = this.loadingCtrl.create({
      content: 'Mohon tunggu sebentar…',
    });

    loader.present().then(() => {
      this.service.ubahUsername(this.username.value, this.password.value).subscribe(res => {
        loader.dismiss()
        if (res == "sukses") {
          this.service.showToast('Data berhasil diperbaharui', 'toastBiru');
          this.navCtrl.pop();
        } else if (res == "ada") {
          this.service.showToast('Username sudah dipakai orang lain', 'toastMerah');
        } else {
          this.service.showToast('Password yang anda masukkan salah!', 'toastMerah');
        }
      });
    });
  }

  ubahPassword() {
    if (this.password1.value != this.password2.value) {
      this.service.showToast('Konfirmasi password baru salah!', 'toastMerah');
    } else {
      let loader = this.loadingCtrl.create({
        content: 'Mohon tunggu sebentar…',
      });
      loader.present().then(() => {
        this.service.ubahPassword(this.password1.value, this.password2.value, this.password3.value).subscribe(res => {
          loader.dismiss()
          if (res == "sukses") {
            this.service.showToast('Password berhasil dirubah', 'toastBiru');
            this.navCtrl.pop();
          } else {
            this.service.showToast('Konfirmasi password lama salah!', 'toastMerah');
          }
        });
      });
    }
  }



}
