import { Component, OnInit, Output, EventEmitter, Input } from '@angular/core';
import { ObtenerDeudaService } from 'src/app/Service/api/obtener-deuda.service';

@Component({
  selector: 'app-comercio',
  templateUrl: './comercio.component.html',
  styleUrls: ['./comercio.component.css']
})
export class ComercioComponent implements OnInit {
  resultadoDeuda: any; 
  nroCuenta: number;
  constructor(private consultaApi: ObtenerDeudaService) { 

  }
  ngOnInit(): void {
  }
  OnClick(){
    this.consultaApi.getDeuda("comercio", this.nroCuenta)
    .then((response) =>{
      this.resultadoDeuda = {
        message: response['message'],
        deuda: response['deuda']
      }
      console.log(response);
    })
    .catch(error => console.log(error));
  }
}
