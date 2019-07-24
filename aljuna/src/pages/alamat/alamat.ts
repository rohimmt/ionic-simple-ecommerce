import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, AlertController, LoadingController } from 'ionic-angular';
import { Service } from '../service/service';
import { TambahalamatPage } from '../tambahalamat/tambahalamat';
import { EditalamatPage } from '../editalamat/editalamat';


@IonicPage()
@Component({
  selector: 'page-alamat',
  templateUrl: 'alamat.html',
})
export class AlamatPage {

  data: any = [];
  alamat: any = {};

  constructor(public navCtrl: NavController, public navParams: NavParams, private service: Service, public alertCtrl: AlertController, private loadingCtrl: LoadingController) {
  }

  ionViewWillEnter(){
    this.getAlamat();
  }
  
  getAlamat() {
    let loader = this.loadingCtrl.create({
      content: "Mohon tunggu..."
    });
    loader.present().then(() => {
    this.service.getAlamat().subscribe(res => {
      this.data = res;
      loader.dismiss();
    }, err => {
      console.log(err);
    });
  });
  }

  edit(a){
    this.navCtrl.push(EditalamatPage,{
    a:a
    });
  }

  hapus(a) {
    
    this.alamat.action = "hapus";
    this.alamat.id_alamat = a.id_alamat;
    const confirm = this.alertCtrl.create({
      title: 'Konfirmasi',
      message: 'Yakin ingin menghapus?',
      buttons: [
        {
          text: 'Tidak',
        },
        {
          text: 'Ya',
          handler: () => {
            this.service.crudAlamat(this.alamat).subscribe(res => {
              let loader = this.loadingCtrl.create({
                content: "Mohon tunggu..."
              });
              loader.present().then(() => {
              if (res == "success") {
                this.getAlamat();
                loader.dismiss();
                this.service.showToast("Berhasil dihapus", 'toastBiru');
              } else {
                loader.dismiss();
                this.service.showToast(res, 'toastMerah');
              }
            }, err => {
              console.log(err);
            });
          });
          }
        }
      ]
    });
    confirm.present();
  
  }

  tambahAlamat(){
    this.navCtrl.push(TambahalamatPage);
  }

}
