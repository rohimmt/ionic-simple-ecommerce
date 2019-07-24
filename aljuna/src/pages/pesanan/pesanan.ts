import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, LoadingController } from 'ionic-angular';
import { Service } from '../service/service';
import { RekapPage } from '../rekap/rekap';
import { Rekap1Page } from '../rekap1/rekap1';

/**
 * Generated class for the PesananPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-pesanan',
  templateUrl: 'pesanan.html',
})
export class PesananPage {
  pesanan: any = [];
  data: any = {};

  constructor(public navCtrl: NavController, public navParams: NavParams, private service: Service, private loadingCtrl: LoadingController) {
  }

  ionViewWillEnter(){
    this.getPesanan();
  }

  getPesanan(){
    let loader = this.loadingCtrl.create({
      content: "Mohon tunggu..."
    });
    loader.present().then(() => {
    this.data.action = "get";
    this.service.pesanan(this.data).subscribe(res=>{
      this.pesanan = res;
      loader.dismiss();
    }, err =>{
      console.log(err);
    });
  });
    
  }

  goToRekap(p){
    this.navCtrl.push(Rekap1Page,{
    p:p
    });
  }

}
