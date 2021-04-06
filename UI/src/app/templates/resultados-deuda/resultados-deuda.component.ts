
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
  }
  onClick() {
   let datosPago = {
     version : "2.0",
     operacion: "op_pago",
     id_organismo: "37",
     token: "af4251381271ba2310fdda689cfc8aeb",
     convenio: "",
     numero_operacion: "123123",
     id_moneda_operacion: "1",
     monto_operacion: 2331,
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
    let contEpago = document.querySelector('.container-epagos');
    form.target = "epagos";
    let iframe = document.createElement('iframe');
    iframe.name = "epagos";
    iframe.frameBorder="0";
    iframe.src = "";
    iframe.style.width = "100%";
    iframe.style.height = "700px";
    contEpago.appendChild(iframe);
    document.body.appendChild(form);
    form.submit();  
  }
}
