import { Component } from '@angular/core';

import { Platform } from '@ionic/angular';
import { SplashScreen } from '@ionic-native/splash-screen/ngx';
import { StatusBar } from '@ionic-native/status-bar/ngx';
import {HttpClient} from "@angular/common/http";
import {AuthService} from "./services/auth.service";

@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html'
})
export class AppComponent {
  user: any;

  public appPages = [
    {
        title: 'Login',
        url: '/login',
        icon: 'list'
    },
      {
      title: 'Home',
      url: '/home',
      icon: 'home'
    },
    {
      title: 'List',
      url: '/list',
      icon: 'list'
    }
  ];

  constructor(
    private platform: Platform,
    private splashScreen: SplashScreen,
    private statusBar: StatusBar,
    private http: HttpClient,
    public auth: AuthService
  ) {
    this.initializeApp();
  }

  initializeApp() {
    this.auth.user().then(user =>{
      this.user = user;
    });
    this.platform.ready().then(() => {
      this.statusBar.styleDefault();
      this.splashScreen.hide();
    });
  }

  logout(){
    this.auth.logout().then(()=> {
      alert('Logout Feito');
    })
  }
}
