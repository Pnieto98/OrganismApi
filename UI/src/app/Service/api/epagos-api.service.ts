import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';


@Injectable({
  providedIn: 'root'
})
export class EpagosApiService {
  baseUrl: string  ;
  constructor(private http: HttpClient) {
    this.baseUrl =  "http://127.0.0.1:8000/api/pagarDeuda";
   }
   iniciarSolicitud(body): Promise <any>
   {
    let tributo = body[0].tipo_tributo;
    const httpOptions = {
      headers: new HttpHeaders({
        'Content-Type':  'text/html'
      })
    };
    return this.http.post<any>(`${this.baseUrl}/${tributo}`, body, httpOptions).toPromise();
   }
}
