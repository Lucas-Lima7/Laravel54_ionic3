import {enableProdMode, NgModule, NgModuleRef} from '@angular/core';
import { platformBrowserDynamic } from '@angular/platform-browser-dynamic';

import { AppModule } from './app/app.module';
import { environment } from './environments/environment';
import {appContainer} from "./app/app.container";

if (environment.production) {
  enableProdMode();
}

platformBrowserDynamic().bootstrapModule(AppModule)
    .then((module:NgModuleRef<AppModule>) => {
      appContainer(module.injector);
    })
  .catch(err => console.log(err));
