import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, LoadingController } from 'ionic-angular';
import { Service } from '../service/service';
import { Storage } from '@ionic/storage';
import { TroliPage } from '../troli/troli';
import { MasukPage } from '../masuk/masuk';

@IonicPage()
@Component({
  selector: 'page-detail',
  templateUrl: 'detail.html',
})
export class DetailPage {
  value: any = [];
  troli: any = [];
  tahu: any = {};
  data: any = {};
  gambar: any;
  jumlah: any = 0 ;
 
  constructor(public navCtrl: NavController, public navParams: NavParams, private service: Service, private storage: Storage, private loadingCtrl: LoadingController) {
    this.value = navParams.get('b');
    this.gambar = this.service.getGambar("barang");
  }

  tambahKeTroli() {
    let loader = this.loadingCtrl.create({
      content: "Mohon tunggu..."
    });
    loader.present().then(() => {
      this.storage.get("session").then((val) => {
        if (val == null) {
          this.service.showToast("Anda harus login terlebih dahulu", 'toastMerah');
          this.navCtrl.setRoot(MasukPage);
          loader.dismiss();
        } else {
          this.data.aksi = "tambah";
          this.data.jumlah = (this.jumlah).toString();
          this.data.kode_barang = this.value.kode_barang;
          this.service.tambahKeTroli(this.data).subscribe(res => {
            console.log(this.data);
            if (res == "ditambahkan") {
              this.service.showToast("Berhasil ditambahkan ke troli", 'toastBiru');
              this.navCtrl.push(TroliPage);
            }
            else if (res == "diubah") {
              this.service.showToast("Berhasil ditambahkan ke troli", 'toastBiru');
              this.navCtrl.push(TroliPage);
            }
            else if (res == "melebihi") {
              this.service.showToast("Jumlah pesanan barang ini melebihi stok! Periksa kembali troli anda!", 'toastMerah');
            }
            else {
              this.service.showToast("Terjadi Kesalahan", 'toastMerah');
            }
          }, err => {
            console.log(err);
          });
          loader.dismiss();
        }
      });
    });
  }

  getStok(num: number) {
    return Array.from({ length: num }, (v, k) => k + 1);
  }


}
