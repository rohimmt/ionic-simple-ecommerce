import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';
import { PengaturanPage } from '../pengaturan/pengaturan';
import { MasukPage } from '../masuk/masuk';
import { Storage } from '@ionic/storage';
import { AlamatPage } from '../alamat/alamat';
import { TrolPage } from '../trol/trol';
import { PesananPage } from '../pesanan/pesanan';
import { Rekap1Page } from '../rekap1/rekap1';
import { Service } from '../service/service';

@Component({
  selector: 'page-akun',
  templateUrl: 'akun.html'
})
export class AkunPage {

  constructor(public navCtrl: NavController, private storage: Storage, private service: Service) {
  }

  ionViewWillEnter(){
    this.cekSession();
  }

  cekSession() {
    this.storage.get("session").then((val) => {
      if (val == null) {
        // this.navCtrl.push(MasukPage);
        this.navCtrl.setRoot(MasukPage);
      } else {
      }
    });
  }

  goToPengaturan(){
    this.navCtrl.push(PengaturanPage);
  }
  goToPesanan(){
    this.navCtrl.push(PesananPage);
  }
  goToAlamat(){
    this.navCtrl.push(AlamatPage);
  }
  trol(){
    this.navCtrl.push(TrolPage);
  }
  rekap1(){
    this.navCtrl.push(Rekap1Page);
  }

  keluar(){
    this.storage.clear();
    this.service.setSesi(null);
    this.navCtrl.setRoot(MasukPage);
  }
}
