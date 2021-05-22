import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { CategoriesTabPageRoutingModule } from './categories-tab-routing.module';

import { CategoriesTabPage } from './categories-tab.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    CategoriesTabPageRoutingModule
  ],
  declarations: [CategoriesTabPage]
})
export class CategoriesTabPageModule {}
