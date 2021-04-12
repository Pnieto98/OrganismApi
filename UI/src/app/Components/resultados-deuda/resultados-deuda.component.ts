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
  redireccionar: boolean;
  constructor(
    private deudaSelec: DeudaSeleccionadaService,
    private epagosService: EpagosApiService
  ) {
    this.redireccionar = true;
  }
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
  enviarPago() {
    this.redireccionar = false;
    this.epagosService
      .iniciarSolicitud(this.deudaSelec.arraySeleccionado)
      .then((datos) => this.realizarPago(datos))
      .catch((error) => console.log(error));
  }
  private realizarPago(datos) {
    let datosPago = {
      version: '2.0',
      operacion: 'op_pago',
      id_organismo: '0',
      token: datos.token,
      convenio: '',
      numero_operacion: datos.token,
      id_moneda_operacion: '1',
      monto_operacion: datos.saldo,
      detalle_operacion: '',
      detalle_operacion_visible: '0',
      ok_url: 'https://postsandbox.epagos.com.ar/tests/ok.php',
      error_url: 'https://postsandbox.epagos.com.ar/tests/error.php',
    };
    this.crearFormulario(datosPago);
    
  }
  private crearFormulario(datosPago){
    let form = document.createElement('form');
    form.method = 'POST';
    form.action = 'https://postsandbox.epagos.com.ar';

    for (const nombre in datosPago) {
      let input = document.createElement('input');
      input.type = 'hidden';
      input.name = nombre;
      input.value = datosPago[nombre];
      form.appendChild(input);
    }
    document.body.appendChild(form);
    form.submit();
  }
}
