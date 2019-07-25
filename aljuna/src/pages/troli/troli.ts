import { Component, ViewChild } from '@angular/core';
import { NavController, AlertController, LoadingController } from 'ionic-angular';
import { Service } from '../service/service';
import { TambahalamatPage } from '../tambahalamat/tambahalamat';
import { PesananPage } from '../pesanan/pesanan';
import { RekapPage } from '../rekap/rekap';
import { Rekap1Page } from '../rekap1/rekap1';

@Component({
  selector: 'page-troli',
  templateUrl: 'troli.html'
})
export class TroliPage {

  troli: any = [];
  alamat: any = [];
  gambar: any;
  pesanan: any = {};
  // round: number;
  @ViewChild("id_alamat") id_alamat;

  constructor(public navCtrl: NavController, private service: Service, public alertCtrl: AlertController,private loadingCtrl: LoadingController) {
    this.gambar = this.service.getGambar("barang");
  }

  ionViewWillEnter() {
      this.getTroli(this.pesanan.id_alamat);
      this.getAlamat();
  }

  ionViewDidLoad() {
  }

  getTroli($event) {  
    let loader = this.loadingCtrl.create({
      content: "Mohon tunggu..."
    });
    loader.present().then(() => {
    let val = $event;
    this.service.getTroli().subscribe(res => {
      this.troli = res;
      this.pesanan.subtotal = 0;
      this.pesanan.subtotalongkir = 0;
      this.pesanan.berat = 0;
      this.pesanan.round = 0;
      if (res != null) {
        res.forEach((r) => {
          this.pesanan.subtotal += Number(r.harga * r.jumlah);
          this.pesanan.berat += Number(r.berat * r.jumlah);
        });
      }
      this.service.getAlamat().subscribe(res1 => {
        if (res1 != null) {
           
          res1.forEach((r) => {
            if (r.id_alamat == val) {
              
              this.pesanan.tarif = r.tarif;
              this.pesanan.round = Math.round(this.pesanan.berat / 1000);
              if (this.pesanan.round <= (this.pesanan.berat / 1000)) {
                this.pesanan.round = this.pesanan.round + 1;
              } else if (this.pesanan.round == 0) {
                this.pesanan.round = 1;
              }
              this.pesanan.subtotal = this.pesanan.subtotal;
              this.pesanan.subtotalongkir = this.pesanan.round * this.pesanan.tarif;
            }
          });
          loader.dismiss();
        }
      });
     
    }, err => {
      console.log(err);
    });
  });
   
  }

  getAlamat() {
    this.service.getAlamat().subscribe(res => {
      this.alamat = res;
    }, err => {
      console.log(err);
    });
  }

  goToRekapPesanan() {
    if (this.pesanan.id_alamat == "" || this.pesanan.id_alamat == null) {
      this.service.showToast("Harap pilih alamat tujuan pengiriman", 'toastMerah');
    } else {
      this.pesanan.action = "submit";
      let loader = this.loadingCtrl.create({
        content: "Mohon tunggu..."
      });
      loader.present().then(() => {
      this.service.pesanan(this.pesanan).subscribe(res => {
        loader.dismiss();
        if (res == "success") {
          this.service.showToast("Pesanan berhasil dibuat", 'toastBiru');
          this.navCtrl.push(Rekap1Page);
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

  hapus(t) {
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
            this.service.hapusTroli(t.id_troli).subscribe(res => {
              if (res == "dihapus") {
                this.service.showToast("Berhasil dihapus", 'toastBiru');
                this.getTroli(this.pesanan.id_alamat);
              } else {
              
                this.service.showToast("Terjadi kesalahan", 'toastMerah');
              }
            }, err => {
              console.log(err);
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
