import { Component, OnInit } from '@angular/core';
import { Router, Routes, ActivatedRoute } from '@angular/router';
import { FormBuilder, FormGroup, Validators, FormControl } from '@angular/forms';
import { PostService } from '../../../../_services/post/post.service';
import { formControlBinding } from '@angular/forms/src/directives/ng_model';
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-add',
  templateUrl: './add.component.html',
  styleUrls: ['./add.component.css']
})
export class AddComponent implements OnInit {
  PostForm : FormGroup;
  id: FormControl;
  post : any = {};
  thumbnailPath: string = "assets/images/thumbnaillogo.png";
  fileToUpload: File = null;
  constructor(private activeRoute : ActivatedRoute,
    private fb:FormBuilder,
  private postservice : PostService,
private toastr : ToastrService ) { }
  validation_messages = {
    'title': [
      { type: 'required', message: 'Contact name is required' }
    ]
  }
  ngOnInit() {
     let url = this.activeRoute.snapshot.params.id;
     this.Form();
     if(url)
       this.GetPostByUrl(url)
  
  }
  GetPostByUrl(url){
    this.postservice.GetPostByUrl(url).subscribe((data:any)=>{
      debugger;
      let body = data[0];
     this.PostForm.reset({
       id : body.Id,
       title : body.Title,
       description : body.Description,
       video : body.Video,
       mypost : body.Mypost
     });
    this.thumbnailPath = 'assets/uploads/'+body.ImageUrl;
    });
  }

  Form() {
    this.PostForm = this.fb.group({
      id: new FormControl(''),
      title : new FormControl('',{
        validators : Validators.compose([
          Validators.required
        ]),
        updateOn: 'change'
      }),
      description : new FormControl(''),
      video : new FormControl(),
      mypost : new FormControl()
    },
    {updateOn: 'submit'})
  }

  handleFileInput(file: FileList) {
    this.fileToUpload = file.item(0);
    var reader = new FileReader();
    reader.onload = (event:any) => {
      this.thumbnailPath = event.target.result;
    }
    reader.readAsDataURL(this.fileToUpload);
  }

  AddPost(value) {
    debugger;
    this.postservice.AddPost(this.fileToUpload,value).subscribe((data: any)=>{
    debugger;
    this.toastr.success(data);
    })
  }




}
