import { Component, OnInit } from '@angular/core';
import { EpagosApiService } from 'src/app/Service/epagos-api.service';

@Component({
  selector: 'app-comercio',
  templateUrl: './comercio.component.html',
  styleUrls: ['./comercio.component.css']
})
export class ComercioComponent implements OnInit {
  arrayDatos: any[];
  respuestaError: boolean; 
  nroCuenta: number;
  tipoTributo: string;
  dniContribuyente: number;
  nombreContribuyente: string;
  constructor(private consultaApi: EpagosApiService) { 
    this.arrayDatos = [];
    this.respuestaError = false;
    this.nroCuenta = 0;
    this.tipoTributo = "comercio"
    this.dniContribuyente = 0;
  }

  ngOnInit(): void {
  }
  OnClick(){
    this.consultaApi.getDeuda("comercio", this.nroCuenta)
    .then((response) =>{
      if(response['message'] == true){
        this.respuestaError = false;
        this.arrayDatos = response['deuda']        
      }else{
        this.arrayDatos = [];
        this.respuestaError = true;
      }
    })
    .catch(error => console.log(error));
  }

}
