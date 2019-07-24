import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { Service } from '../service/service';

/**
 * Generated class for the TrolPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-trol',
  templateUrl: 'trol.html',
})
export class TrolPage {
  troli: any = [];
  alamat: any = [];
  gambar: any;
  pesanan: any = {};
  constructor(public navCtrl: NavController, public navParams: NavParams, private service: Service) {
  }

  ionViewWillEnter() {
    this.getTroli();
    this.getAlamat();
  }

  getTroli() {
    this.service.getTroli().subscribe(res => {
      this.troli = res;
    }, err => {
      console.log(err);
    });
  }

  getAlamat() {
    this.service.getAlamat().subscribe(res => {
      this.alamat = res;
    }, err => {
      console.log(err);
    });
  }

}
