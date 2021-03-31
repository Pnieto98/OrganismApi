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
  nroCuenta: number;
  datos: number;
  constructor() { 

  }

  ngOnInit() {
  }
}
