import { Component } from '@angular/core';

import { AkunPage } from '../akun/akun';
import { Storage } from '@ionic/storage';
import { TroliPage } from '../troli/troli';
import { HomePage } from '../home/home';
import { NavController } from 'ionic-angular';
import { MasukPage } from '../masuk/masuk';


@Component({
  templateUrl: 'tabs.html'
})
export class TabsPage {
  kondisi: any;

  tab1Root = HomePage;
  tab2Root = AkunPage;
  tab3Root = TroliPage;

  constructor(public navCtrl: NavController, private storage: Storage) {

  }

  ionViewDidEnter(){
    this.storage.get("session").then((val) => {
      if (val == null) {
      } else {
        console.log(val);
      }
    });
  }
  
}
