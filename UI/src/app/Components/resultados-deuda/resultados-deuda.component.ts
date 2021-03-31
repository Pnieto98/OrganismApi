import { Component, Input, OnInit } from '@angular/core';



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
    this.resultadoDeuda;
  }

  ngOnInit(): void {
    console.log(this.resultadoDeuda);
  }
}
