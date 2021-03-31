import { Component, OnInit, Output, EventEmitter, Input } from '@angular/core';
import { ObtenerDeudaService } from 'src/app/Service/api/obtener-deuda.service';

@Component({
  selector: 'app-comercio',
  templateUrl: './comercio.component.html',
  styleUrls: ['./comercio.component.css']
})
export class ComercioComponent implements OnInit {
  resultadoDatos: any;
  constructor() { 
  }
  ngOnInit(): void {
  }
  onObtenerResultados($event){ 
    this.resultadoDatos = $event;
  }
}
