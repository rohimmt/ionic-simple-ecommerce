import { Injectable } from "@angular/core";
import { Http, RequestOptions, Headers } from "@angular/http";
import 'rxjs/Rx';
import { Observable } from 'rxjs/Observable';
import { Storage } from '@ionic/storage';
import { ToastController, AlertController } from "ionic-angular";
import { FileTransfer, FileUploadOptions, FileTransferObject } from '@ionic-native/file-transfer';

@Injectable()
export class Service {

    options: any;
    sesi: string;
    url: string = 'https://rocky-cove-78199.herokuapp.com/api/';
    urlgambar: string = 'https://rocky-cove-78199.herokuapp.com/assets/images/';

    constructor(private http: Http, private storage: Storage, public toast: ToastController,
        public alertCtrl: AlertController, private transfer: FileTransfer) {

        var headers = new Headers();
        headers.append("Accept", 'application/json');
        headers.append('Content-Type', 'application/json');
        headers.append('Cache-Control', 'no-cache');

        this.options = new RequestOptions({ headers: headers });
        this.storage.get("session").then((val) => {
            this.sesi = val;
        });
    }

    showToast(message, warna: string) {
        let toast = this.toast.create({
            message: message,
            duration: 2000,
            position: 'top',
            cssClass: warna
        });
        toast.present();
    }

    setSesi(id) {
        this.sesi = id;
    }

    getGambar(dir) {
        return this.urlgambar + dir + "/";
    }

    unggah(bukti) {
        const fileTransfer: FileTransferObject = this.transfer.create();
        var random = Math.floor(Math.random() * 1000000000);

        let options: FileUploadOptions = {
            fileKey: 'photo',
            fileName: "bukti_" + random + ".jpg",
            chunkedMode: false,
            httpMethod: 'post',
            mimeType: "image/jpeg",
            headers: {}
        }
        return fileTransfer.upload(bukti, this.url + 'unggah.php', options)
    }

    getKota() {
        return this.http.get(this.url + 'kota.php', this.options)
            .map(res => res.json())
            .catch(this.handleError)
    }

    getKategori() {
        return this.http.get(this.url + 'kategori.php', this.options)
            .map(res => res.json())
            .catch(this.handleError)
    }

    getPesanan() {
        return this.http.get(this.url + 'pesanan.php', this.options)
            .map(res => res.json())
            .catch(this.handleError)
    }

    findBarang(cari, param) {
        return this.http.get(this.url + 'barang.php?cari=' + cari + '&parameter=' + param)
            .map(res => res.json())
            .catch(this.handleError)
    }

    getBarang(param) {
        return this.http.get(this.url + 'barang.php?id_kategori=' + param)
            .map(res => res.json())
            .catch(this.handleError)
    }

    getUser() {
        return this.http.get(this.url + 'user.php?id_user=' + this.sesi)
            .map(res => res.json())
            .catch(this.handleError)
    }

    getAlamat() {
        return this.http.get(this.url + 'alamat.php?id_user=' + this.sesi)
            .map(res => res.json())
            .catch(this.handleError)
    }

    masuk(username, password) {
        let data = {
            username: username,
            password: password
        };
        return this.http.post(this.url + 'masuk.php', data, this.options)
            .map(res => res.json())
            .catch(this.handleError)
    }

    daftar(data) {
        return this.http.post(this.url + 'daftar.php', data, this.options)
            .map(res => res.json())
            .catch(this.handleError)
    }

    crudAlamat(data) {
        data.id_user = this.sesi;
        return this.http.post(this.url + 'alamat.php', data, this.options)
            .map(res => res.json())
            .catch(this.handleError)
    }

    getTroli() {
        return this.http.get(this.url + 'troli.php?id_user=' + this.sesi)
            .map(res => res.json())
            .catch(this.handleError)
    }

    tambahKeTroli(data) {
        data.id_user = this.sesi;
        return this.http.post(this.url + 'troli.php', data, this.options)
            .map(res => res.json())
            .catch(this.handleError)
    }

    hapusTroli(id_troli) {
        return this.http.get(this.url + 'troli.php?id_troli=' + id_troli)
            .map(res => res.json())
            .catch(this.handleError)
    }

    pesanan(data) {
        data.id_user = this.sesi;
        return this.http.post(this.url + 'pesanan.php', data, this.options)
            .map(res => res.json())
            .catch(this.handleError)
    }

    ubahUsername(username, password) {
        let data = {
            aksi: "1",
            id_user: this.sesi,
            username: username,
            password: password
        };
        return this.http.post(this.url + 'pengaturan.php', data, this.options)
            .map(res => res.json())
            .catch(this.handleError)
    }

    ubahPassword(password1, password2, password3) {
        let data = {
            aksi: "2",
            id_user: this.sesi,
            password1: password1,
            password2: password2,
            password3: password3
        };
        return this.http.post(this.url + 'pengaturan.php', data, this.options)
            .map(res => res.json())
            .catch(this.handleError)
    }

    cek(data) {
        data.id_user = this.sesi;
        return this.http.post(this.url + 'cek.php', data, this.options)
            .map(res => res.json())
            .catch(this.handleError)
    }

    handleError(error) {
        return Observable.throw(error.json().error || 'server error');
    }
}