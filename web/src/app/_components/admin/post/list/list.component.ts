import { Component, OnInit } from '@angular/core';
import { PostService } from '../../../../_services/post/post.service';
import { DataService } from '../../../../_services/data.service';
import { ToastrService } from 'ngx-toastr';
import { NgxSpinnerService } from 'ngx-spinner';


@Component({
  selector: 'app-list',
  templateUrl: './list.component.html',
  styleUrls: ['./list.component.css']
})
export class ListComponent implements OnInit {
  data : any[];
  PostId:any;
    constructor(private _post : PostService,
    private dataservice : DataService,
    private toastr: ToastrService,
    private spinner: NgxSpinnerService
  ) { }
  
    ngOnInit() {
      this.spinner.show();
      this._post.GetPost(1,15).subscribe((data:any)=>{
        this.spinner.hide();
        
        this.data = data.post;
      })
  
      this.dataservice.deleteData.subscribe(id=>{
        this.spinner.show();
        
        if(id>0){
        this.data = this.data.filter(c=>c.Id !== id);
        this._post.DeletePost(id).subscribe((res:any)=>{ 
          this.spinner.hide();
          if(res>0){
            
            this.toastr.success('Deleted.', '');
          }
        },
        error => {console.log(error)});
      }
      })
    }
    getId(data){
      
      this.PostId = data.Id;
    }

}
