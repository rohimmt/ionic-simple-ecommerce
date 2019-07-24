import { Http } from '@angular/http';
import 'rxjs/add/operator/map';
import { Component, ViewChild } from '@angular/core';
import { NavController, ViewController, LoadingController, AlertController } from 'ionic-angular';
import { DetailPage } from '../detail/detail';
import { Service } from '../service/service';
import { PesananPage } from '../pesanan/pesanan';

@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {
  @ViewChild("id_kategori") id_kategori;
  gambar: any;
  barang: any = [];
  kategori: any = [];
  find: string;
  data: any = {};

  constructor(
    public navCtrl: NavController,
    public http: Http,
    private service: Service, private loadingCtrl: LoadingController, public alertCtrl: AlertController,
    public viewCtrl: ViewController) {
    this.gambar = this.service.getGambar("barang");
  }

  ionViewWillEnter() {
    this.getBarang();
  }

  ionViewDidLoad(){
    this.getKategori();
  }

  getBarang() {
      this.service.getBarang(this.id_kategori.value).subscribe(res => {
        this.barang = res;
      }, err => {
        console.log(err);
    });
  }

  cek() {
    this.data.action = "cek";
    this.service.cek(this.data).subscribe(res => {
      if (res.tolak > 0) {
        const confirm = this.alertCtrl.create({
          title: 'Peringatan!',
          message: 'Terdapat pesanan dengan bukti pembayaran yang salah, mohon untuk mengunggah ulang bukti pembayaran yang valid sebelum batas waktu pembayaran habis!',
          buttons: [
            {
              text: 'Oke',
              handler: () => {
                this.navCtrl.push(PesananPage);
              }
            }
          ]
        });
        confirm.present();
      } if (res.bbayar > 0) {
        const confirm = this.alertCtrl.create({
          title: 'Peringatan!',
          message: 'Terdapat pesanan yang belum anda bayar. Segera upload bukti pembayaran sebelum melampaui batas waktu pembayaran!',
          buttons: [
            {
              text: 'Oke',
              handler: () => {
                this.navCtrl.push(PesananPage);
              }
            }
          ]
        });
        confirm.present();
      } if (res.batal > 0) {
        const confirm = this.alertCtrl.create({
          title: 'Peringatan!',
          message: 'Terdapat pesanan yang dibatalkan otomatis karena telah melampaui batas waktu pembayaran!',
          buttons: [
            {
              text: 'Oke',
              handler: () => {
                this.data.action = "batal";
                this.service.cek(this.data).subscribe();
              }
            }
          ]
        });
        confirm.present();
      }
    }, err => {
      console.log(err);
    });
  }

  findBarang(ev: any) {
    let val = ev.target.value;
    this.service.findBarang(val, this.id_kategori.value).subscribe(res => {
      this.barang = res;
    }, err => {
      console.log(err);
    });
  }

  getKategori() {
    this.service.getKategori().subscribe(res => {
      this.kategori = res;
      this.cek();
    }, err => {
      console.log(err);
    });
  }

  getDetail(b) {
    this.navCtrl.push(DetailPage, {
      b: b
    });
  }

  filterKategori($event) {
    // let loader = this.loadingCtrl.create({
    //   content: "Mohon tunggu..."
    // });
    // loader.present();
    this.find = "";
    let val = $event;
    if ($event == "") {
      this.getBarang();
      // loader.dismiss();
    } else {
      this.service.getBarang(val).subscribe(output => {
        this.barang = output;
        // loader.dismiss();
      }, err => {
        console.log(err);
      });
    }

  }

}
