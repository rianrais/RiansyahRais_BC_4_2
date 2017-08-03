import { Component, OnInit, Input, Output } from '@angular/core';
import { Form } from '@angular/forms';

import { ApiService } from '../api.service';

@Component({
  selector: 'app-course-list',
  templateUrl: './course-list.component.html',
  styleUrls: ['./course-list.component.css']
})
export class CourseListComponent implements OnInit {

  courseList: Object[];

  addCourse() {
    this.api.addCourse({ 'course_name' : this.newCourseName });
  }

  constructor(private api: ApiService) { }

  ngOnInit() {
    this.courseList = this.api.getCourseList();
  }

  newCourseName: string = "";

}
