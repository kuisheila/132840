from django.urls import path
from authentication.api.views import EditUserAPIView, GetTokenView, GetUserView, LoginView, RegisterUserView,RegisterAPIView


urlpatterns = [
    path('register/', RegisterAPIView.as_view(), name='register'),
    path('get-token/', GetTokenView.as_view(), name='get_token'),
    path('login/', LoginView.as_view(), name='login'),
    path('user/', GetUserView.as_view(), name='get_user'),
    path('edit-user/<int:pk>/', EditUserAPIView.as_view(), name='EditUsersView')

]

