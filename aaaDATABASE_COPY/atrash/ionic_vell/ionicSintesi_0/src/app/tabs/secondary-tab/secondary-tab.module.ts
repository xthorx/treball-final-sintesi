import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { SecondaryTabPageRoutingModule } from './secondary-tab-routing.module';

import { SecondaryTabPage } from './secondary-tab.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    SecondaryTabPageRoutingModule
  ],
  declarations: [SecondaryTabPage]
})
export class SecondaryTabPageModule {}
