import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, ActionSheetController, LoadingController, AlertController } from 'ionic-angular';
import { Service } from '../service/service';
import { Camera, CameraOptions } from '@ionic-native/camera';

@IonicPage()
@Component({
  selector: 'page-rekap1',
  templateUrl: 'rekap1.html',
})
export class Rekap1Page {
  pesanan1: any = {};
  pesanan: any = [];
  barang: any = [];
  urlbukti: any;
  urlpesanan: any
  bukti: any;
  rekap: any;

  constructor(public navCtrl: NavController, public navParams: NavParams, private service: Service, public actionSheetCtrl: ActionSheetController,
    private camera: Camera,
    private loadingCtrl: LoadingController,
    public alertCtrl: AlertController) {
    this.rekap = navParams.get('p');
    this.urlbukti = this.service.getGambar("bukti");
    this.urlpesanan = this.service.getGambar("pesanan");
  }

  ionViewWillEnter() {
    this.getRekap1();
  }

  getRekap1() {
    let loader = this.loadingCtrl.create({
      content: "Mohon tunggu..."
    });
    this.rekap = this.navParams.get('p');
    loader.present();
    if (this.rekap == null || this.rekap == "") {
      this.pesanan1.action = "rekap1";
    } else {
      this.pesanan1.action = "rekap";
      this.pesanan1.id_pesanan = this.rekap.id_pesanan;
    }
    this.service.pesanan(this.pesanan1).subscribe(res => {
      this.pesanan = res;
      res.forEach((r) => {
        this.pesanan1.action = "rekap1barang";
        if (this.rekap == null || this.rekap == "") {
          this.pesanan1.id_pesanan = r.id_pesanan;
        }
        this.service.pesanan(this.pesanan1).subscribe(res => {
          this.barang = res;
        }, err => {
          console.log(err);
        });

      });
      loader.dismiss();
    }, err => {
      console.log(err);
    });
    
  }

  pilih() {
    const actionSheet = this.actionSheetCtrl.create({
      title: 'Pilih pengambilan gambar',
      buttons: [
        {
          text: 'Kamera',
          icon: 'camera',
          handler: () => {
            this.kamera();
          }
        }, {
          text: 'Galeri',
          icon: 'images',
          handler: () => {
            this.galeri();
          }
        }, {
          text: 'Batal',
          role: 'cancel',
          icon: 'close-circle',
          handler: () => {
          }
        }
      ]
    });
    actionSheet.present();
  }

  kamera() {
    const options: CameraOptions = {
      quality: 60,
      destinationType: this.camera.DestinationType.DATA_URL,
      encodingType: this.camera.EncodingType.JPEG,
      mediaType: this.camera.MediaType.PICTURE
    }

    this.camera.getPicture(options).then((imageData) => {
      // imageData is either a base64 encoded string or a file URI
      // If it's base64:
      this.bukti = 'data:image/jpeg;base64,' + imageData;
    }, (err) => {
      // Handle error
    });

  }

  galeri() {
    const options: CameraOptions = {
      quality: 60,
      destinationType: this.camera.DestinationType.DATA_URL,
      sourceType: this.camera.PictureSourceType.PHOTOLIBRARY,
      saveToPhotoAlbum: false
    }

    this.camera.getPicture(options).then((imageData) => {
      // imageData is either a base64 encoded string or a file URI
      // If it's base64:
      this.bukti = 'data:image/jpeg;base64,' + imageData;
    }, (err) => {
      // Handle error
    });
  }

  unggah(p) {
    //Show loading
    if (this.bukti == null || this.bukti == "") {
      this.service.showToast('Harap lampirkan bukti pembayaran terlebih dahulu', 'toastMerah');
    } else {
      let loader = this.loadingCtrl.create({
        content: "Mengunggah..."
      });
      loader.present();

      this.service.unggah(this.bukti).then((res) => {
        this.pesanan1.action = "unggah";
        this.pesanan1.id_pesanan = p.id_pesanan;
        this.pesanan1.bukti = res.response;
        this.service.pesanan(this.pesanan1).subscribe(res => {
          if (res == "success") {
            this.getRekap1();
            loader.dismiss();
            this.service.showToast("Bukti pembayaran berhasil diunggah", 'toastBiru');
          }
        }, err => {
          console.log(err);
        });
        
      }, (err) => {
        console.log(err);
        alert("Error");
        loader.dismiss();
      });
    }
  }

  ok() {
    this.navCtrl.pop();
    console.log(this.rekap);
  }

  batal() {
    const confirm = this.alertCtrl.create({
      title: 'Konfirmasi',
      message: 'Yakin ingin membatalkan pesanan?',
      buttons: [
        {
          text: 'Tidak',
        },
        {
          text: 'Ya',
          handler: () => {
            this.pesanan1.action = "batalkan";
            this.pesanan1.id_pesanan = this.pesanan[0].id_pesanan;
            this.service.pesanan(this.pesanan1).subscribe(res => {
              if (res == "success") {
                this.getRekap1();
                this.service.showToast("Pesanan dibatalkan.", 'toastBiru');
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

  terima() {
    const confirm = this.alertCtrl.create({
      title: 'Konfirmasi',
      message: 'Pesanan sudah diterima?',
      buttons: [
        {
          text: 'Tidak',
        },
        {
          text: 'Ya',
          handler: () => {
            this.pesanan1.action = "terima";
            this.pesanan1.id_pesanan = this.pesanan[0].id_pesanan;
            this.service.pesanan(this.pesanan1).subscribe(res => {
              if (res == "success") {
                this.getRekap1();
                this.service.showToast("Pesanan diterima.", 'toastBiru');
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


}
