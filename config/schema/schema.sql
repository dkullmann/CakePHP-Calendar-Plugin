reate syntax for TABLE 'attendees'
CREATE TABLE `attendees` (
  `id` varchar(36) NOT NULL,
  `user_id` varchar(36) NOT NULL,
  `event_id` varchar(36) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'requiredparticipant',
  `rsvp` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Create syntax for TABLE 'calendars'
CREATE TABLE `calendars` (
  `id` varchar(36) NOT NULL,
  `user_id` varchar(36) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `CALENDAR_USER_FK` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Create syntax for TABLE 'events'
CREATE TABLE `events` (
  `id` varchar(36) NOT NULL,
  `calendar_id` varchar(36) NOT NULL,
  `title` varchar(255) NOT NULL,
  `rate` float DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `recurring` tinyint(1) NOT NULL DEFAULT '0',
  `time_zone` varchar(100) NOT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `EVENTS_CALENDAR_FK` (`calendar_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Create syntax for TABLE 'recurrence_rules'
CREATE TABLE `recurrence_rules` (
  `id` varchar(36) NOT NULL,
  `event_id` varchar(36) NOT NULL,
  `bydaydays` varchar(30) NOT NULL,
  `frequency` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `RECURRENCE_EVENT_FK` (`event_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
