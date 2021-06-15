import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { CocktailTabPageRoutingModule } from './cocktail-tab-routing.module';

import { CocktailTabPage } from './cocktail-tab.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    CocktailTabPageRoutingModule
  ],
  declarations: [CocktailTabPage]
})
export class CocktailTabPageModule {}
