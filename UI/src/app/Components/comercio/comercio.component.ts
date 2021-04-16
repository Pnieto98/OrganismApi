import { Component, OnInit, Output, EventEmitter, Input } from '@angular/core';
import { Router } from '@angular/router';
import { ObtenerDeudaService } from 'src/app/Service/api/obtener-deuda.service';

@Component({
  selector: 'app-comercio',
  templateUrl: './comercio.component.html', 
  styleUrls: ['./comercio.component.css']
})
export class ComercioComponent implements OnInit {
  resultadoDatos: any; 
  nroCuenta: number;
  ruta: string;
  constructor(private consultaApi: ObtenerDeudaService, private router: Router) { 
    this.ruta = this.router.url;
  }
  ngOnInit(): void {

  }
  onObtenerResultados($event){ 
    this.resultadoDatos = $event;
  }
}
