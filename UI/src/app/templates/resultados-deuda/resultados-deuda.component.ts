import { ChangeDetectorRef, Component, Input, OnInit, ViewChild} from '@angular/core';
import { config } from 'rxjs';
import { BuscarDeudaComponent } from 'src/app/Form/buscar-deuda/buscar-deuda.component';




@Component({
  selector: 'app-resultados-deuda',
  templateUrl: './resultados-deuda.component.html',
  styleUrls: ['./resultados-deuda.component.css']
})
export class ResultadosDeudaComponent  implements OnInit {
  @Input() resultadoDeuda: any;
  totalSeleccion
  mostrarSeleccion: any[];
  nroCuenta: number;
  datos: number;
  isChecked: boolean;
  constructor() { 
    this.mostrarSeleccion = [];
    this.totalSeleccion = 0;
  }
  ngOnInit() {
  }
  eventCheck(obj, $event){
    this.isChecked = $event.target.checked;
    if(this.isChecked){
      this.mostrarSeleccion.push(obj);
      this.totalSeleccion+=obj.saldo;
    }else{
      let element = this.mostrarSeleccion.indexOf(obj)
      this.mostrarSeleccion.splice(element, 1); 
      this.totalSeleccion-=obj.saldo;
    }
  }
}
