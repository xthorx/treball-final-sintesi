import { Component, OnInit } from "@angular/core";
import { DataService } from "../../services/data.service";

@Component({
  selector: 'app-secondary-tab',
  templateUrl: './secondary-tab.page.html',
  styleUrls: ['./secondary-tab.page.scss'],
})
export class SecondaryTabPage implements OnInit {
  public searchTerm: string = "";
  public items: any;

  constructor(private dataService: DataService) {}

  ngOnInit() {
    this.setFilteredItems();
  }

  setFilteredItems() {
    this.items = this.dataService.filterItems(this.searchTerm);
  }
}