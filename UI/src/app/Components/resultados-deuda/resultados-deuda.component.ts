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
  /** EVENTO CHECK PARA AGREGAR LA DEUDA SELECCIONADA A UN ARRAY**/
  eventCheck(obj, $event) {
    this.isChecked = $event.target.checked;
    if (this.isChecked) {
      this.deudaSelec.agregar(obj);
    } else {
      this.deudaSelec.borrar(obj);
    }
  }
  /** PETICION HTTP A LA API PARA REALIZAR EL PAGO **/
  enviarPago() {
    this.redireccionar = false;
    this.epagosService
      .iniciarSolicitud(this.deudaSelec.arraySeleccionado)
      .then((datos) => this.realizarPago(datos))
      .catch((error) => console.log(error));
  }
  /** GENERA UN FORM CON LOS DATOS DEL CONTRIBUYENTE QUE 
   *  DEVUELVE LA API */
  private realizarPago(datos) {
    let form = document.createElement('form');
    form.method = 'POST';
    form.action = 'https://postsandbox.epagos.com.ar';
    for (const nombre in datos) {
      let input = document.createElement('input');
      input.type = 'hidden';
      input.name = nombre;
      input.value = datos[nombre];
      form.appendChild(input);
    }
    document.body.appendChild(form);
    form.submit();
  }
}
