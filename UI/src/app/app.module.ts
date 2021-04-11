import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeaderComponent } from './templates/header/header.component';
import { HttpClientModule } from '@angular/common/http';
import { InicioComponent } from './Components/inicio/inicio.component';
import { ComercioComponent } from './Components/comercio/comercio.component';
import { CementerioComponent } from './Components/cementerio/cementerio.component';
import { FormsModule } from '@angular/forms';
import { ResultadosDeudaComponent } from './Components/resultados-deuda/resultados-deuda.component';
import { BuscarDeudaComponent } from './Form/buscar-deuda/buscar-deuda.component';
import { FooterComponent } from './templates/footer/footer.component';


@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    InicioComponent,
    ComercioComponent,
    CementerioComponent,
    ResultadosDeudaComponent,
    BuscarDeudaComponent,
    FooterComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent, FooterComponent]
})
export class AppModule { }
