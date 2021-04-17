import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class DeudaSeleccionadaService {
  arraySeleccionado: any;
  sumarTotales: number;
  constructor() { 
    this.arraySeleccionado = [];
    this.sumarTotales = 0;
  }
  agregar(obj: any){
    this.arraySeleccionado.push(obj);
    this.sumarTotales+=obj.monto;
  }
  borrar(obj: any){
    let element = this.arraySeleccionado.indexOf(obj)
    this.arraySeleccionado.splice(element, 1); 
    this.sumarTotales-=obj.monto;
  }
  getSeleccionado(){
    return this.arraySeleccionado;
  }
}
