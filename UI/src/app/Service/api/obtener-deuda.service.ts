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
   getDeuda(tipoTributo, idContribuyente): Promise <any []>
   {
     return this.http.get<any[]>(`${this.baseUrl}/${tipoTributo}/${idContribuyente}`).toPromise();
   }

}
