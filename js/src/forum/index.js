import app from 'flarum/forum/app';
import { extend } from 'flarum/common/extend';
import NotificationList from 'flarum/forum/components/NotificationList';
import { findFirstVdomChild } from './util/findVdomChild';
import Tooltip from 'flarum/common/components/Tooltip';
import Button from 'flarum/common/components/Button';
import NotificationListState from 'flarum/forum/states/NotificationListState';

app.initializers.add('blomstra/notification-deleter', () => {
  NotificationListState.prototype.deleteAll = function() {
    if (this.pages.length === 0) return;

    app.session.user?.pushAttributes({ unreadNotificationCount: 0 });

    this.pages = [];

    return app.request({
      url: app.forum.attribute('apiUrl') + '/notifications/delete',
      method: 'DELETE',
    });
  };

  extend(NotificationList.prototype, 'view', function (vnode) {
    const state = this.attrs.state;

    findFirstVdomChild(vnode, '.App-primaryControl', function (vnode) {
      if (!Array.isArray(vnode.children)) vnode.children = [vnode.children];

      vnode.children.push(
        <Tooltip text={app.translator.trans('blomstra-notification-deleter.forum.notifications.delete_all_tooltip')}>
          <Button
            className="Button Button--link"
            data-container=".NotificationList"
            icon="fas fa-trash-alt"
            title={app.translator.trans('blomstra-notification-deleter.forum.notifications.delete_all_tooltip')}
            onclick={() => {
              if (confirm(app.translator.trans('blomstra-notification-deleter.forum.notifications.delete_all_confirm'))) {
                state.deleteAll.call(state);
              }
            }}
          />
        </Tooltip>
      );
    });
  });
});
