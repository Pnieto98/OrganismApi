import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CementerioComponent } from './Components/cementerio/cementerio.component';
import { ComercioComponent } from './Components/comercio/comercio.component';
import { InicioComponent } from './Components/inicio/inicio.component';


const routes: Routes = [
  {
    path: 'inicio',
    component: InicioComponent
  },
  {
    path: 'comercio',
    component: ComercioComponent
  },
  {
    path: 'cementerio',
    component: CementerioComponent
  },
  {
    path: '',
    pathMatch: "full",
    component: InicioComponent
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
