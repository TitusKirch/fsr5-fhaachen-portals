/**
 * This file is auto generated using 'php artisan typescript:generate'
 *
 * Changes to this file will be lost when the command is run again
 */

declare namespace App.Models {
  export interface Course {
    id: number;
    created_at: string | null;
    updated_at: string | null;
    name: string;
    abbreviation: string;
    icon: string;
    show_on_registration: boolean;
    classes: string;
    users?: Array<App.Models.User> | null;
    groups?: Array<App.Models.Group> | null;
    users_count?: number | null;
    groups_count?: number | null;
  }

  export interface Group {
    id: number;
    name: string;
    created_at: string | null;
    updated_at: string | null;
    event_id: number;
    course_id: number | null;
    telegram_group_link: string | null;
    group_tutors?: Array<App.Models.GroupTutor> | null;
    registrations?: Array<App.Models.Registration> | null;
    stops?: Array<App.Models.Stop> | null;
    course?: App.Models.Course | null;
    event?: App.Models.Event | null;
    tutors?: Array<App.Models.User> | null;
    stations?: Array<App.Models.Station> | null;
    group_tutors_count?: number | null;
    registrations_count?: number | null;
    stops_count?: number | null;
    tutors_count?: number | null;
    stations_count?: number | null;
  }

  export interface Registration {
    id: number;
    created_at: string | null;
    updated_at: string | null;
    event_id: number;
    user_id: number;
    slot_id: number | null;
    group_id: number | null;
    drinks_alcohol: boolean | null;
    fulfils_requirements: boolean | null;
    is_present: boolean;
    form_responses: Array<any> | any | null;
    queue_position: number | null;
    event?: App.Models.Event | null;
    user?: App.Models.User | null;
    slot?: App.Models.Slot | null;
    group?: App.Models.Group | null;
  }

  export interface Event {
    id: number;
    created_at: string | null;
    updated_at: string | null;
    name: string;
    description: string | null;
    registration_from: string | null;
    registration_to: string | null;
    type: string;
    has_requirements: boolean;
    consider_alcohol: boolean;
    form: Array<any> | any | null;
    sort_order: number;
    groups?: Array<App.Models.Group> | null;
    registrations?: Array<App.Models.Registration> | null;
    slots?: Array<App.Models.Slot> | null;
    stations?: Array<App.Models.Station> | null;
    groups_count?: number | null;
    registrations_count?: number | null;
    slots_count?: number | null;
    stations_count?: number | null;
  }

  export interface Station {
    id: number;
    created_at: string | null;
    updated_at: string | null;
    name: string;
    event_id: number;
    stops?: Array<App.Models.Stop> | null;
    event?: App.Models.Event | null;
    tutors?: Array<App.Models.User> | null;
    groups?: Array<App.Models.Group> | null;
    stops_count?: number | null;
    tutors_count?: number | null;
    groups_count?: number | null;
  }

  export interface State {
    id: number;
    key: string;
    value: Array<any> | any | null;
    created_at: string | null;
    updated_at: string | null;
  }

  export interface Module {
    id: number;
    key: string;
    active: boolean;
    created_at: string | null;
    updated_at: string | null;
  }

  export interface Page {
    id: number;
    created_at: string | null;
    updated_at: string | null;
    title: string;
    slug: string;
    content: string;
    sort_order: number;
  }

  export interface StationTutor {
    id: number;
    created_at: string | null;
    updated_at: string | null;
    user_id: number;
    station_id: number;
    user?: App.Models.User | null;
    station?: App.Models.Station | null;
  }

  export interface Slot {
    id: number;
    name: string;
    created_at: string | null;
    updated_at: string | null;
    event_id: number;
    has_requirements: boolean;
    maximum_participants: number | null;
    form: Array<any> | any | null;
    telegram_group_link: string | null;
    registrations?: Array<App.Models.Registration> | null;
    event?: App.Models.Event | null;
    registrations_count?: number | null;
  }

  export interface GroupTutor {
    id: number;
    created_at: string | null;
    updated_at: string | null;
    user_id: number;
    group_id: number;
    user?: App.Models.User | null;
    group?: App.Models.Group | null;
  }

  export interface Stop {
    id: number;
    created_at: string | null;
    updated_at: string | null;
    group_id: number;
    station_id: number;
    arrival_at: string | null;
    departure_at: string | null;
    group?: App.Models.Group | null;
    station?: App.Models.Station | null;
  }

  export interface User {
    id: number;
    created_at: string | null;
    updated_at: string | null;
    firstname: string;
    lastname: string;
    email: string;
    course_id: number;
    remember_token: string | null;
    is_disabled: boolean;
    avatar: string | null;
    station_tutors?: Array<App.Models.StationTutor> | null;
    group_tutors?: Array<App.Models.GroupTutor> | null;
    registrations?: Array<App.Models.Registration> | null;
    course?: App.Models.Course | null;
    station_tutors_count?: number | null;
    group_tutors_count?: number | null;
    registrations_count?: number | null;
  }
}
