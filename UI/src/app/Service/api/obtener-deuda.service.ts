import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ObtenerDeudaService {
  baseUrl: string  ;
  constructor(private http: HttpClient) {
    this.baseUrl =  "http://127.0.0.1:8000/api/consulta";
   }
  /* El metodo getDeuda retorna una promesa con la deuda del contribuyente
   * Recibe -> 
   *         °El tipo de atributo, ejemplo: "Comercio"o "Patente"
   *         °El id con el cual se le identifica al contribuyente, ejemplo: "312ac" o "2451"
   */
   getDeuda(tipoTributo, idContribuyente): Promise <any []>
   {
     return this.http.get<any[]>(`${this.baseUrl}/${tipoTributo}/${idContribuyente}`).toPromise();
   }

}
