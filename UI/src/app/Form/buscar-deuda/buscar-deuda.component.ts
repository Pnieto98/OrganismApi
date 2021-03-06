import { Component, OnInit, Output, EventEmitter, Input } from '@angular/core';
import { ObtenerDeudaService } from 'src/app/Service/api/obtener-deuda.service';
import { DeudaSeleccionadaService } from 'src/app/Service/deuda-seleccionada.service';

@Component({
  selector: 'app-buscar-deuda',
  templateUrl: './buscar-deuda.component.html',
  styleUrls: ['./buscar-deuda.component.css'],
})
export class BuscarDeudaComponent implements OnInit {
  resultadoDeuda: any;
  nroCuenta: number;
  activarSpinner: boolean;
  @Input() tipoDeuda: string;
  @Output() enviarDatos: EventEmitter<any>;
  constructor(
    private consultaApi: ObtenerDeudaService,
    private deudaSelec: DeudaSeleccionadaService
  ) {
    this.enviarDatos = new EventEmitter();
    this.activarSpinner = true;
  }
  ngOnInit(): void {
  }
  OnClick() {
    if(this.deudaSelec.arraySeleccionado.length > 0){
      this.deudaSelec.sumarTotales = 0;
      this.deudaSelec.arraySeleccionado = [];
    }
    this.activarSpinner = false;
    this.consultaApi
      .getDeuda(this.tipoDeuda, this.nroCuenta)
      .subscribe((response) => {
        this.activarSpinner = true;
        this.resultadoDeuda = {
          message: response['message'],
          deuda: response['datosDeuda'],
          contribuyente : response['datosContribuyente']
        };
        this.enviarDatos.emit(this.resultadoDeuda);
      })
  }
}
