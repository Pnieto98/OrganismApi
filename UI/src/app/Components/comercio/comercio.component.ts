import { Component, OnInit } from '@angular/core';
import { EpagosApiService } from 'src/app/Service/epagos-api.service';

@Component({
  selector: 'app-comercio',
  templateUrl: './comercio.component.html',
  styleUrls: ['./comercio.component.css']
})
export class ComercioComponent implements OnInit {
  arrayDatos: any[];
  constructor(private consultaApi: EpagosApiService) { 
    this.arrayDatos = [];
  }

  ngOnInit(): void {
    this.consultaApi.getDeuda("comercio", 4)
    .then(response => this.arrayDatos = response['deuda'])
    .catch(error => console.log(error));
  }
  OnClick(){
    console.log("Asd");
  }

}
