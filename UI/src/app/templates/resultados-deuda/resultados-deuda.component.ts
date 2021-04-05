import {Component, Input, OnInit} from '@angular/core';
import { DeudaSeleccionadaService } from 'src/app/Service/deuda-seleccionada.service';

@Component({
  selector: 'app-resultados-deuda',
  templateUrl: './resultados-deuda.component.html',
  styleUrls: ['./resultados-deuda.component.css']
})
export class ResultadosDeudaComponent  implements OnInit {
  @Input() resultadoDeuda: any;
  isChecked: boolean;
  constructor(private deudaSelec: DeudaSeleccionadaService) { 
  }
  ngOnInit() {
  }
  eventCheck(obj, $event){
    this.deudaSelec.arraySeleccionado;
    this.isChecked = $event.target.checked;
    if(this.isChecked){
      this.deudaSelec.agregar(obj);
    }else{
      this.deudaSelec.borrar(obj);
    }
  }
  pagar(){
    console.log(this.deudaSelec.arraySeleccionado);
  }
}
