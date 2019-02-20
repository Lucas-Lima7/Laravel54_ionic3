import { Injectable } from '@angular/core';
import {JwtCredentials} from "../models/jwt-credentials";
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {Storage} from "@ionic/storage";
import {JwtHelperService} from "@auth0/angular-jwt";

//const helper = new JwtHelperService();

@Injectable({
  providedIn: 'root'
})
export class JwtClientService {

    private _token = null;
    private _payload = null;


    constructor(
        private authHttp: HttpClient,
        public storage:Storage,
        public jwtHelper: JwtHelperService) {
        this.getToken();
        this.getPayload().then((payload)=>{
            console.log(payload);
        })
    }

    getPayload(): Promise<Object> {
        return new Promise((resolve) => {
            if (this._payload) {
                resolve(this._payload);
            }
                this.getToken().then(token => {
                    if (token) {
                        this._payload = this.jwtHelper.decodeToken(token['token']);
                    }
                    resolve(this._payload);
                });
        });
    }

    getToken():Promise<string>{
        return new Promise((resolve) => {
            if(this._token){
                resolve(this._token);
            }
            this.storage.get('token').then((token) => {
                this._token = token;
                resolve(this._token);
            });
        });
    }

    accessToken(jwtCredentials: JwtCredentials): Promise<string>{
        return this.authHttp.post('http://localhost:8000/api/access_token',jwtCredentials)
            .toPromise()
            .then( (response) => {
                let token = response;
            /*.then( data => {
                let token = data;*/
                this._token = token;
                this.storage.set('token', this._token);
                return token;
            });
    }

    revokeToken():Promise<null>{
        const httpOptions = {
            headers: new HttpHeaders({
                'Authorization': `Bearer ${this._token}`
                })
            };
        /*let headers = new HttpHeaders();
        headers.set('Authorization', `Bearer ${this._token}`);*/
        return this.authHttp.post('http://localhost:8000/api/logout', {}, httpOptions)
            .toPromise()
            .then( (response: Response) => {
                this._token = null;
                this._payload = null;
                this.storage.clear();
                return null;
            });
    }

    /*accessToken(jwtCredentials: JwtCredentials){
      this.http.post('http://localhost:8000/api/access_token',jwtCredentials)
          .subscribe( (data: JwtCredentials) => {
              //console.log(data)
              let token = data.json().token;
              return token;
          });
  }*/

    /*accessToken(jwtCredentials: JwtCredentials){
        this.http.post('http://localhost:8000/api/access_token',  jwtCredentials    )
            .subscribe( data => {
                let token = data.token;
                console.log(token);
            });
    }*/
}
