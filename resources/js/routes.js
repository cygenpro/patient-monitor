import AddPatient from "./components/Doctor/AddPatient";
import DoctorHome from "./components/Doctor/DoctorHome";
import PatientHome from "./components/Patient/PatientHome";
import NewRecord from "./components/Patient/NewRecord";

let routes = [];

if( window.authUser ) {
    if( window.authUser.is_doctor ) {
        routes = [
            {path: '/', component: DoctorHome},
            {path: '/add-patient', component: AddPatient},
            {path: '/patient/:id', component: DoctorHome}
        ];
    } else {
        routes = [
            {path: '/', component: PatientHome},
            {path: '/doctor/:id', component: PatientHome},
            {path: '/new-record', component: NewRecord}
        ]
    }
}

export {routes};
