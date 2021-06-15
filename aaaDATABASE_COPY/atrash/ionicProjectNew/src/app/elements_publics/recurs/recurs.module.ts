import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { RecursPageRoutingModule } from './recurs-routing.module';

import { RecursPage } from './recurs.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    RecursPageRoutingModule
  ],
  declarations: [RecursPage]
})
export class RecursPageModule {}
