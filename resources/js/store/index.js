import { createStore } from 'vuex'
import { AuthModule } from './modules/AuthModule'
import { DoctorModule } from './modules/DoctorModule'
import { PatientModule } from './modules/PatientModule'
import { AdminModule } from './modules/AdminModule'
import { SpecialityModule } from './modules/SpecialityModule'
import { KeywordModule } from './modules/KeywordModule'
import { WorkstimeModule } from './modules/WorkstimeModule'
import { AppointmentsTypeModule } from './modules/AppointmentsTypeModule'
import { AppointmentModule } from './modules/AppointmentModule'

export default createStore({
  modules: {
    AuthModule: AuthModule,
    DoctorModule: DoctorModule,
    PatientModule: PatientModule,
    AdminModule: AdminModule,
    SpecialityModule: SpecialityModule,
    KeywordModule: KeywordModule,
    WorkstimeModule: WorkstimeModule,
    AppointmentsTypeModule: AppointmentsTypeModule,
    AppointmentModule: AppointmentModule
  }
})
