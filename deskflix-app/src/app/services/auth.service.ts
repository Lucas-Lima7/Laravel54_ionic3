import { Injectable } from '@angular/core';
import {JwtClientService} from "./jwt-client.service";
import {JwtPayload} from "../models/jwt-payload";

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  private _user = null;

  constructor(public jwtClient: JwtClientService) {
    this.user().then((user)=>{
      console.log(user);
    })
  }

  user(): Promise<Object> {
      return new Promise((resolve) => {
          if (this._user) {
              resolve(this._user);
          }
          this.jwtClient.getPayload().then((payload: JwtPayload) => {
              if(payload) {
                  this._user = payload.user;
              }
              resolve(this._user);
          });
      });
  }

  check():Promise<boolean>{
      return this.user().then(user => {
          return user !== null;
      })
  }

  login({email, password}){
    return this.jwtClient.accessToken({email, password})
        .then(()=>{
          return this.user();
        })
  }

  logout(){
    return this.jwtClient
        .revokeToken()
        .then(()=> {
          this._user = null;
        });
  }
}
