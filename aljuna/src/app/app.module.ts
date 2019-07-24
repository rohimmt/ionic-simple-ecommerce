import { NgModule, ErrorHandler } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { IonicApp, IonicModule, IonicErrorHandler } from 'ionic-angular';
import { MyApp } from './app.component';

import { AkunPage } from '../pages/akun/akun';
import { TroliPage } from '../pages/troli/troli';
import { HomePage } from '../pages/home/home';
import { DetailPage } from '../pages/detail/detail';
import { PengaturanPage } from '../pages/pengaturan/pengaturan';
import { PesananPage } from '../pages/pesanan/pesanan';
import { AlamatPage } from '../pages/alamat/alamat';
import { TambahalamatPage } from '../pages/tambahalamat/tambahalamat';
import { EditalamatPage } from '../pages/editalamat/editalamat';
import { TrolPage } from '../pages/trol/trol';
import { RekapPage } from '../pages/rekap/rekap';
import { Rekap1Page } from '../pages/rekap1/rekap1';
import { DaftarPage } from '../pages/daftar/daftar';
import { MasukPage } from '../pages/masuk/masuk';
import { TabsPage } from '../pages/tabs/tabs';
import { Service } from '../pages/service/service';

import { IonicStorageModule } from '@ionic/storage';
import { HttpModule } from '@angular/http';
import { HttpClientModule } from '@angular/common/http';
import { StatusBar } from '@ionic-native/status-bar';
import { SplashScreen } from '@ionic-native/splash-screen';
import { FormsModule } from '@angular/forms';
import { CustomFormsModule } from 'ng2-validation'
import { Camera } from '@ionic-native/camera';
import { FileTransfer } from '@ionic-native/file-transfer';

@NgModule({
  declarations: [
    MyApp,
    AkunPage,
    TroliPage,
    HomePage,
    DetailPage,
    PengaturanPage,
    PesananPage,
    AlamatPage,
    TambahalamatPage,
    EditalamatPage,
    TrolPage,
    RekapPage,
    Rekap1Page,
    DaftarPage,
    MasukPage,
    TabsPage
  ],
  imports: [
    BrowserModule,
    FormsModule, CustomFormsModule,
    HttpModule,
    HttpClientModule,
    IonicStorageModule.forRoot(),
    IonicModule.forRoot(MyApp)
  ],
  bootstrap: [IonicApp],
  entryComponents: [
    MyApp,
    AkunPage,
    TroliPage,
    HomePage,
    DetailPage,
    PengaturanPage,
    PesananPage,
    AlamatPage,
    TambahalamatPage,
    EditalamatPage,
    TrolPage,
    RekapPage,
    Rekap1Page,
    DaftarPage,
    MasukPage,
    TabsPage
  ],
  providers: [
    Camera,
    FileTransfer,
    StatusBar,
    SplashScreen,
    Service,
    {provide: ErrorHandler, useClass: IonicErrorHandler}
  ]
})
export class AppModule {}
