
import { Component, Input, OnInit } from '@angular/core';
import { EpagosApiService } from 'src/app/Service/api/epagos-api.service';
import { DeudaSeleccionadaService } from 'src/app/Service/deuda-seleccionada.service';
@Component({
  selector: 'app-resultados-deuda',
  templateUrl: './resultados-deuda.component.html',
  styleUrls: ['./resultados-deuda.component.css'],
})
export class ResultadosDeudaComponent implements OnInit {
  @Input() resultadoDeuda: any;
  isChecked: boolean;
  constructor(
    private deudaSelec: DeudaSeleccionadaService,
    private epagosService: EpagosApiService
  ) {}
  ngOnInit() {}
  eventCheck(obj, $event) {
    this.deudaSelec.arraySeleccionado;
    this.isChecked = $event.target.checked;
    if (this.isChecked) {
      this.deudaSelec.agregar(obj);
    } else {
      this.deudaSelec.borrar(obj);
    }
    console.log(encodeURIComponent(JSON.stringify(this.deudaSelec.arraySeleccionado)))
  }
  enviarPago(){
    this.epagosService.iniciarSolicitud(this.deudaSelec.arraySeleccionado)
    .then(response => this.realizarPago(response))
    .catch(error => console.log(error) )
  }
  private realizarPago(token) {
   let datosPago = {
     version : "2.0",
     operacion: "op_pago",
     id_organismo: "0",
     token: token,
     convenio: "",
     numero_operacion: "123123",
     id_moneda_operacion: "1",
     monto_operacion: this.deudaSelec.sumarTotales,
     detalle_operacion: "",
     detalle_operacion_visible: "0",
     ok_url: "https://postsandbox.epagos.com.ar/tests/ok.php" ,
     error_url: "https://postsandbox.epagos.com.ar/tests/error.php",
    }
    let form = document.createElement("form")
    form.method = "POST";
    form.action = "https://postsandbox.epagos.com.ar";
    
    for(const nombre in datosPago){
      let input = document.createElement("input");
      input.type = "hidden";
      input.name = nombre;
      input.value = datosPago[nombre];
      form.appendChild(input);
    }
    document.body.appendChild(form);
    form.submit();  
  }
}
