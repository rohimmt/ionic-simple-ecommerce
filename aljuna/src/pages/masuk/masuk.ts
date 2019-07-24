import { Component, ViewChild } from '@angular/core';
import { IonicPage, NavController, NavParams, AlertController } from 'ionic-angular';
import { DaftarPage } from '../daftar/daftar';
import { LoadingController, ToastController } from 'ionic-angular';
import { Storage } from '@ionic/storage';
import { Service } from '../service/service';
import { AkunPage } from '../akun/akun';
import { AbstractControl, FormGroup, FormBuilder, Validators } from '@angular/forms';

@IonicPage()
@Component({
  selector: 'page-masuk',
  templateUrl: 'masuk.html',
})
export class MasukPage {
  @ViewChild("username") username;
  @ViewChild("password") password;

  formgroup: FormGroup;
  user: AbstractControl;
  pass: AbstractControl;

  constructor(public navCtrl: NavController, public alertCtrl: AlertController, public toastCtrl: ToastController,
    public loading: LoadingController, private storage: Storage, private service: Service, public formbuilder: FormBuilder) {
    this.formgroup = formbuilder.group({
      user: ['', Validators.compose([Validators.minLength(3), Validators.pattern('[a-zA-Z 0-9]*'), Validators.required])],
      pass: ['', Validators.compose([Validators.minLength(6), Validators.pattern('[a-zA-Z 0-9]*'), Validators.required])]
    });

    this.user = this.formgroup.controls['user'];
    this.pass = this.formgroup.controls['pass'];
  }

  masuk() {
    let loader = this.loading.create({
      content: 'Mohon tunggu sebentar…',
    });
    loader.present().then(() => {
      this.service.masuk(this.username.value, this.password.value).subscribe(res => {
        loader.dismiss()
        console.log(res);
        if (res != "salah") {
          this.service.showToast("Berhasil masuk ke akun", 'toastBiru');
          this.storage.set("session", res);
          this.service.setSesi(res);
          this.navCtrl.setRoot(AkunPage);
        } else {
          this.service.showToast("Username/password salah", 'toastMerah');
        }
      });
    });
  }

  goToDaftar() {
    this.navCtrl.setRoot(DaftarPage);
  }
}