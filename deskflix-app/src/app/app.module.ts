import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { RouteReuseStrategy } from '@angular/router';

import { IonicModule, IonicRouteStrategy } from '@ionic/angular';
import { SplashScreen } from '@ionic-native/splash-screen/ngx';
import { StatusBar } from '@ionic-native/status-bar/ngx';

import { AppComponent } from './app.component';
import { AppRoutingModule } from './app-routing.module';
import {HttpClientModule} from "@angular/common/http";
import {IonicStorageModule, Storage} from "@ionic/storage";
import {JwtClientService} from "./services/jwt-client.service";
import {JWT_OPTIONS, JwtHelperService, JwtModule} from "@auth0/angular-jwt";
import {AuthService} from "./services/auth.service";

export function tokenGetter() {
    return localStorage.getItem('access_token');
}

@NgModule({
  declarations: [AppComponent],
  entryComponents: [],
  imports: [
    BrowserModule,
    IonicModule.forRoot(),
    AppRoutingModule,
      HttpClientModule,
      IonicStorageModule.forRoot({
          driverOrder: ['localstorage']
      }),
      JwtModule.forRoot({
          /*jwtOptionsProvider: {
            provide: JWT_OPTIONS,
              deps: [HttpClientModule, Storage],
              useFactory(http, storage){
                let authConfig = new authConfig({
                    headerPrefix: 'Bearer',
                    noJwtError: true,
                    noClientCheck: true,
                    tokenGetter: (()=> storage.get('token'))
                });
              }
          }*/
          config: {
              tokenGetter: tokenGetter,
          }
      }),
  ],
  providers: [
    StatusBar,
    SplashScreen,
      JwtClientService,
      JwtHelperService,
      AuthService,
    { provide: RouteReuseStrategy, useClass: IonicRouteStrategy },
      /*{
        provide: AuthHttp,

      }*/
  ],
  bootstrap: [AppComponent]
})
export class AppModule {}
