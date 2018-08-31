import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import {DataTableModule} from "angular-6-datatable";
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { NgxSpinnerModule } from 'ngx-spinner';
 
import { ToastrModule } from 'ngx-toastr';
import { AppComponent } from './app.component';
import { AccountComponent } from './_components/account/account.component';
import { DashboardComponent } from './_components/dashboard/dashboard.component';
import { LayoutComponent } from './_layout/layout/layout.component';
import { Route } from './routes';
import { DeleteComponent } from './_model/delete/delete.component';
import { PostComponent } from './_components/post/post.component';
import { HeaderComponent } from './_layout/header/header.component';
import { FooterComponent } from './_layout/footer/footer.component';
import { SidebarComponent } from './_layout/sidebar/sidebar.component';
import { AdminComponent } from './_components/admin/admin.component';
import { AddComponent } from './_components/admin/post/add/add.component';
import { ListComponent } from './_components/admin/post/list/list.component';

@NgModule({
  declarations: [
    AppComponent,
    AccountComponent,
    DashboardComponent,
    LayoutComponent,
    DeleteComponent,
    PostComponent,
    HeaderComponent,
    FooterComponent,
    SidebarComponent,
    AdminComponent,
    AddComponent,
    ListComponent
  ],
  imports: [
    BrowserModule,
    Route,
    HttpClientModule,
    DataTableModule,
    BrowserAnimationsModule, 
    ToastrModule.forRoot(),
    NgxSpinnerModule,
    ReactiveFormsModule,
    FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
