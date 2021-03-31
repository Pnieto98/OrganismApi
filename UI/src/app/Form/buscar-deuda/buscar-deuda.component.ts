import { Component, OnInit, Output, EventEmitter } from '@angular/core';
import { ObtenerDeudaService } from 'src/app/Service/api/obtener-deuda.service';

@Component({
  selector: 'app-buscar-deuda',
  templateUrl: './buscar-deuda.component.html',
  styleUrls: ['./buscar-deuda.component.css']
})
export class BuscarDeudaComponent implements OnInit {
  resultadoDeuda: any; 
  nroCuenta: number;  
  @Output() enviarDatos: EventEmitter<any>;
  constructor(private consultaApi: ObtenerDeudaService) { 
    this.enviarDatos = new EventEmitter();
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
    this.enviarDatos.emit(this.resultadoDeuda);

    })
    .catch(error => console.log(error));
  }

}
