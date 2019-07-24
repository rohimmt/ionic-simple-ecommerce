import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, ActionSheetController, LoadingController, AlertController } from 'ionic-angular';
import { Service } from '../service/service';
import { Camera, CameraOptions } from '@ionic-native/camera';

@IonicPage()
@Component({
  selector: 'page-rekap',
  templateUrl: 'rekap.html',
})
export class RekapPage {
  value: any = [];
  data: any = {};
  barang: any = [];

  bukti: any;
  urlbukti: any;
  urlpesanan: any;

  constructor(public navCtrl: NavController, public navParams: NavParams,
    private service: Service, public actionSheetCtrl: ActionSheetController,
    private camera: Camera,
    private loadingCtrl: LoadingController,
    public alertCtrl: AlertController) {
    this.value = navParams.get('p');
    this.urlbukti = this.service.getGambar("bukti");
    this.urlpesanan = this.service.getGambar("pesanan");
  }

  ionViewWillEnter() {
    this.getPesanan();
  }

  getPesanan() {
    this.data.action = "getBarang";
    this.data.id_transaksi = this.value.id_transaksi;
    this.service.pesanan(this.data).subscribe(res => {
      this.barang = res;
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

  unggah() {
    //Show loading
    let loader = this.loadingCtrl.create({
      content: "Uploading..."
    });
    loader.present();

    this.service.unggah(this.bukti).then((res) => {
      this.data.action = "unggah";
      this.data.id_transaksi = this.value.id_transaksi;
      this.data.bukti = res.response;
      this.service.pesanan(this.data).subscribe(res => {
        if (res == "success") {
          this.service.showToast("Bukti pembayaran berhasil diunggah",'toastBiru');
        }
      }, err => {
        console.log(err);
      });
      loader.dismiss();
    }, (err) => {
      console.log(err);
      alert("Error");
      loader.dismiss();
    });
  }

  ok() {
    console.log(this.value);
    this.navCtrl.pop();
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
            this.data.action = "batalkan";
            this.data.id_transaksi = this.value.id_transaksi;
            this.service.pesanan(this.data).subscribe(res => {
              if (res == "success") {
                this.value = this.navParams.get('p');
                this.getPesanan();
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


}


