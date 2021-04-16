import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-pago-respuesta',
  templateUrl: './pago-respuesta.component.html',
  styleUrls: ['./pago-respuesta.component.css']
})
export class PagoRespuestaComponent implements OnInit {
   respuesta: string;
   cadenaClases: string ;
   iconoOk: string;
   textoRespuesta: string;
   recibo: string;
  constructor(private ruta: ActivatedRoute) { }

  ngOnInit(): void {
    this.ruta.params.subscribe(params =>{
      this.mostrarRespuestaPago(params);
    })
  }
  private  mostrarRespuestaPago(params){
    if(params.respUrl == "acreditado"){
      this.respuesta = "alert-success";
      this.iconoOk = '<i class="far fa-check-circle"></i>';
      this.textoRespuesta = '¡Su pago ha sido acreditado con exito!';
      this.cadenaClases = 'text-success';
      if(params.recibo){
        this.recibo = atob(params.recibo);
      }
    }else{
      this.respuesta = "alert-danger";
      this.iconoOk = '<i class="fas fa-exclamation-circle"></i>';
      this.textoRespuesta = 'Error al procesar el pago, intente nuevamente.';
      this.cadenaClases = 'text-danger';
    }
  }
}
